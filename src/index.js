import { registerBlockType } from "@wordpress/blocks";

import Edit from "./edit";

// No save because this block is server-side rendered

registerBlockType("shb/archivetitle-author", {
	/**
	 * @see ./edit.js
	 */
	edit: Edit,
});
