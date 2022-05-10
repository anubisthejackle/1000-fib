import { TextareaControl, TextControl } from '@wordpress/components';
import { PluginDocumentSettingPanel } from '@wordpress/edit-post';
import { __ } from '@wordpress/i18n';
import React from 'react';

// Components.
import ImagePicker from '@/components/image-picker';

// Services.
import usePostMetaValue from '@/hooks/use-post-meta-value';

const OpenGraph = () => {
  const [description, setDescription] = usePostMetaValue('thousand_fib_open_graph_description');
  const [image, setImage] = usePostMetaValue('thousand_fib_open_graph_image');
  const [title, setTitle] = usePostMetaValue('thousand_fib_open_graph_title');

  return (
    <PluginDocumentSettingPanel
      icon="share"
      name="opengraph"
      title={__('Open Graph', 'thousand-fib')}
    >
      <ImagePicker
        onReset={() => setImage(0)}
        onUpdate={({ id: next }) => setImage(next)}
        value={image}
      />
      <TextControl
        label={__('Title', 'thousand-fib')}
        onChange={(next) => setTitle(next)}
        value={title}
      />
      <TextareaControl
        label={__('Description', 'thousand-fib')}
        onChange={(next) => setDescription(next)}
        value={description}
      />
    </PluginDocumentSettingPanel>
  );
};

export default OpenGraph;
