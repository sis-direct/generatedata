<?php


class DataType_GUID extends DataTypePlugin {
	protected $dataTypeName = "GUID";
	protected $dataTypeFieldGroup = "numeric";
	protected $dataTypeFieldGroupOrder = 50;
	private $generatedGUIDs = array();
	private $helpDialogWidth = 510;


	public function generate($generator, $generationContextData) {
		$placeholderStr = "HHHHHHHH-HHHH-HHHH-HHHH-HHHH-HHHHHHHH";
		$guid = Utils::generateRandomAlphanumericStr($placeholderStr);

		// pretty sodding unlikely, but just in case!
		while (in_array($guid, $this->generatedGUIDs)) {
			$guid = Utils::generateRandomAlphanumericStr($placeholderStr);
		}
		$this->generatedGUIDs[] = $guid;
		return array(
			"display" => $guid
		);
	}

	public function getHelpDialogInfo() {
		return array(
			"dialogWidth" => $this->helpDialogWidth,
			"content"     => "<p>{$this->L["help"]}</p>"
		);
	}

	public function getDataTypeMetadata() {
		return array(
			"SQLField" => "varchar(36) NOT NULL",
			"SQLField_Oracle" => "varchar2(36) NOT NULL"
		);
	}
}