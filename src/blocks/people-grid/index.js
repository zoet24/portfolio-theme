import { registerBlockType } from "@wordpress/blocks";
import "./editor.scss";
import "./style.scss";

registerBlockType("de/people-grid", {
  title: "People Grid",
  icon: "admin-users",
  category: "design-everything",
  edit: () => <p>People Grid block (editor preview)</p>,
  save: () => null, // server-side render
});
