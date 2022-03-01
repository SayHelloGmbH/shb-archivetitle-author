import { __ } from "@wordpress/i18n";
import {
	AlignmentToolbar,
	BlockControls,
	useBlockProps,
} from "@wordpress/block-editor";
import { getBlockDefaultClassName } from "@wordpress/blocks";

export default function Edit({ attributes, setAttributes }) {
	const { textAlign } = attributes;

	let extraProps = {};

	if (!!textAlign) {
		extraProps.className = `has-text-align-${textAlign}`;
	}

	const blockProps = useBlockProps(extraProps),
		classNameBase = getBlockDefaultClassName("shb/archivetitle-author");

	setAttributes({ classNameBase });

	return (
		<div {...blockProps}>
			<BlockControls>
				<AlignmentToolbar
					value={textAlign}
					onChange={(textAlign) => setAttributes({ textAlign })}
				/>
			</BlockControls>
			<h1 className={`${classNameBase}__inner c-editormessage`}>
				{__("Author name", "shb-archivetitle-author")}
			</h1>
		</div>
	);
}
