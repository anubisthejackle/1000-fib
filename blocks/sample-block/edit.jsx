import React from 'react';
import PropTypes from 'prop-types';

import { __ } from '@wordpress/i18n';
import { RichText, useBlockProps } from '@wordpress/block-editor';

import MediaPicker from '@/components/media-picker';

const Edit = ({
  attributes: {
    text,
    mediaId,
  },
  setAttributes,
}) => {
  const blockProps = useBlockProps();

  return (
    // eslint-disable-next-line react/jsx-props-no-spreading
    <div {...blockProps}>
      <RichText
        value={text}
        allowedFormats={['core/bold', 'core/italic']}
        onChange={(content) => setAttributes({ text: content })}
        placeholder={__('Heading...')}
      />
      <MediaPicker
        controlsLocation="block-toolbar"
        onReset={() => setAttributes({ mediaId: 0 })}
        onUpdate={({ id }) => setAttributes({ mediaId: id })}
        value={mediaId}
      />
    </div>
  );
};

Edit.propTypes = {
  attributes: PropTypes.shape({
    text: PropTypes.string.isRequired,
    mediaId: PropTypes.number.isRequired,
  }).isRequired,
  setAttributes: PropTypes.func.isRequired,
};

export default Edit;
