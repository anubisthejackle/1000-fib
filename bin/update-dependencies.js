/* eslint-disable no-console */
const { execSync } = require('child_process');
const { readFileSync, writeFileSync } = require('fs');
const path = require('path');

// Ensure the version was passed.
if (process.argv.length !== 3) {
  console.log('Usage: npm run update-dependencies WPVERSION');
  console.log('Example: npm run update-dependencies 5.9');
  process.exit(1);
}

// Attempt to clone the Gutenberg repo with the specified version.
execSync(`git clone --depth 1 --branch wp/${process.argv[2]} https://github.com/wordpress/gutenberg /tmp/gutenberg`);

// Update package versions.
const packageJSON = JSON.parse(readFileSync(path.join(__dirname, '../package.json')));
['dependencies', 'devDependencies'].forEach((dependencyType) => {
  Object.keys(packageJSON[dependencyType]).forEach((dependency) => {
    if (dependency.includes('@wordpress/')) {
      const packageName = dependency.replace('@wordpress/', '');
      const packageDefinition = JSON.parse(readFileSync(path.join('/tmp/gutenberg/packages', packageName, 'package.json')));
      packageJSON[dependencyType][dependency] = packageDefinition.version;
    }
  });
});

// Update the React version.
const reactPackageJSON = JSON.parse(readFileSync('/tmp/gutenberg/packages/element/package.json'));
packageJSON.dependencies.react = reactPackageJSON.dependencies.react;

// Save the new package.json over the old one and reinstall everything.
writeFileSync(path.join(__dirname, '../package.json'), JSON.stringify(packageJSON, null, '  '));
process.chdir(path.join(__dirname, '../'));
execSync('rm -rf node_modules');
execSync('rm package-lock.json');
execSync('npm install --legacy-peer-deps');

// Clean up.
execSync('rm -rf /tmp/gutenberg');
