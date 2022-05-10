import { registerPlugin } from '@wordpress/plugins';

// Sections.
import OpenGraph from './sections/open-graph';

registerPlugin('thousand-fib-open-graph', { render: OpenGraph });
