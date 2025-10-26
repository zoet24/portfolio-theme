import { RichText, useBlockProps } from "@wordpress/block-editor";

export default function Save({ attributes }) {
  const { title, description, imageUrl, linkUrl } = attributes;
  const blockProps = useBlockProps.save();

  return (
    <div {...blockProps} className="project-card">
      {imageUrl && <img src={imageUrl} alt={title} />}
      <RichText.Content tagName="h3" value={title} />
      <RichText.Content tagName="p" value={description} />
      {linkUrl && (
        <a href={linkUrl} target="_blank" rel="noopener noreferrer">
          View Project
        </a>
      )}
    </div>
  );
}
