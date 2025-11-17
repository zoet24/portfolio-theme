import { RichText, useBlockProps } from "@wordpress/block-editor";
import { registerBlockType } from "@wordpress/blocks";
import "./editor.scss";
import "./style.scss";

registerBlockType("de/fullscreen-columns", {
  title: "Fullscreen Columns",
  icon: "columns",
  category: "layout",
  attributes: {
    swapColumns: { type: "boolean", default: false },
    textContent: { type: "string", default: "Your text here..." },
    imageURL: { type: "string", default: "" },
    imageAlt: { type: "string", default: "" },
  },

  edit: ({ attributes, setAttributes }) => {
    const { swapColumns, textContent, imageURL, imageAlt } = attributes;
    const blockProps = useBlockProps();

    return (
      <div
        {...blockProps}
        className={`fullscreen-columns ${swapColumns ? "swap" : ""}`}
      >
        <input
          type="checkbox"
          checked={swapColumns}
          onChange={(e) => setAttributes({ swapColumns: e.target.checked })}
        />{" "}
        Swap Columns
        <div className="columns">
          <div className="column column-text">
            <RichText
              tagName="p"
              value={textContent}
              onChange={(value) => setAttributes({ textContent: value })}
            />
          </div>
          <div className="column column-image">
            {imageURL && <img src={imageURL} alt={imageAlt} />}
          </div>
        </div>
      </div>
    );
  },

  save: ({ attributes }) => {
    const { swapColumns, textContent, imageURL, imageAlt } = attributes;
    return (
      <div className={`fullscreen-columns ${swapColumns ? "swap" : ""}`}>
        <div className="columns">
          <div className="column column-text">
            <p>{textContent}</p>
          </div>
          <div className="column column-image">
            {imageURL && <img src={imageURL} alt={imageAlt} />}
          </div>
        </div>
      </div>
    );
  },
});
