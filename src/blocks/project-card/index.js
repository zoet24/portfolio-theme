import { registerBlockType } from "@wordpress/blocks";
import Edit from "./edit";
import Save from "./save";
import "./style.css";

registerBlockType("portfolio/project-card", {
  title: "Project Card",
  icon: "portfolio",
  category: "widgets",
  attributes: {
    title: { type: "string", source: "text", selector: "h3" },
    description: { type: "string", source: "text", selector: "p" },
    imageUrl: { type: "string", default: "" },
    linkUrl: { type: "string", default: "" },
  },
  edit: Edit,
  save: Save,
});
