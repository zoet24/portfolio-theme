import { MediaUpload, RichText, useBlockProps } from "@wordpress/block-editor";
import { Button } from "@wordpress/components";
import { __ } from "@wordpress/i18n";

export default function Edit({ attributes, setAttributes }) {
  const { title, description, imageUrl, linkUrl } = attributes;
  const blockProps = useBlockProps();

  return (
    <div {...blockProps} className="project-card">
      <MediaUpload
        onSelect={(media) => setAttributes({ imageUrl: media.url })}
        render={({ open }) => (
          <div className="image-wrapper">
            {imageUrl ? (
              <img src={imageUrl} alt="Project" onClick={open} />
            ) : (
              <Button onClick={open} variant="secondary">
                Upload Image
              </Button>
            )}
          </div>
        )}
      />

      <RichText
        tagName="h3"
        value={title}
        onChange={(value) => setAttributes({ title: value })}
        placeholder={__("Project Title")}
      />

      <RichText
        tagName="p"
        value={description}
        onChange={(value) => setAttributes({ description: value })}
        placeholder={__("Project Description")}
      />

      <input
        type="url"
        value={linkUrl}
        onChange={(e) => setAttributes({ linkUrl: e.target.value })}
        placeholder="Project Link"
      />
    </div>
  );
}
