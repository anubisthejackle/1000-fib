import PropTypes from 'prop-types';
import React from 'react';
import { Button } from '@wordpress/components';
import { MediaUpload, MediaUploadCheck } from '@wordpress/block-editor';
import { __ } from '@wordpress/i18n';
import { useSelect } from '@wordpress/data';

// Services.
import getMediaUrl from 'services/media/get-media-url';

const ImageUpload = ({
  allowedTypes,
  className,
  value,
  imageSize,
  onReset,
  onSelect,
}) => {
  const { media } = useSelect((select) => {
    const { getMedia } = select('core');
    return {
      media: value !== 0 ? getMedia(value) || {} : {},
    };
  });
  return (
    <div
      className={className}
      style={{
        backgroundColor: '#007CBA',
        display: 'inline-block',
        position: 'relative',
      }}
    >
      <MediaUploadCheck>
        <MediaUpload
          title={__('Select/add image', 'wp-starter-plugin')}
          onSelect={onSelect}
          allowedTypes={allowedTypes}
          value={value}
          render={({ open }) => (
            <>
              {value !== 0 && Object.keys(media).length > 0 ? (
                <div>
                  <img
                    alt=""
                    src={getMediaUrl(media, imageSize)}
                  />
                  <div
                    style={{
                      background: 'white',
                      left: '50%',
                      padding: 5,
                      position: 'absolute',
                      top: '50%',
                      transform: 'translate(-50%, -50%)',
                      zIndex: 10,
                    }}
                  >
                    <Button
                      isPrimary
                      isLarge
                      onClick={open}
                      style={{ marginBottom: 0 }}
                    >
                      { __('Replace image', 'wp-starter-plugin')}
                    </Button>
                    <Button
                      isLink
                      isDestructive
                      onClick={onReset}
                      style={{ marginBottom: 0 }}
                    >
                      { __('Remove Image', 'wp-starter-plugin')}
                    </Button>
                  </div>
                </div>
              ) : null}
              {value === 0 ? (
                <div
                  style={{
                    background: 'white',
                    padding: 5,
                  }}
                >
                  <Button
                    isPrimary
                    onClick={open}
                  >
                    { __('Select/add image', 'wp-starter-plugin')}
                  </Button>
                </div>
              ) : null}
            </>
          )}
        />
      </MediaUploadCheck>
    </div>
  );
};

ImageUpload.defaultProps = {
  allowedTypes: [],
  className: '',
  imageSize: 'thumbnail',
};

ImageUpload.propTypes = {
  allowedTypes: PropTypes.arrayOf([PropTypes.string]),
  className: PropTypes.string,
  value: PropTypes.number.isRequired,
  imageSize: PropTypes.string,
  onReset: PropTypes.func.isRequired,
  onSelect: PropTypes.func.isRequired,
};

export default ImageUpload;
