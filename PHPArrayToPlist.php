<?php

/**
 * Permet de générer un fichier Plist depuis un Array
 *
 * @author		Marceau Casals <marceau@casals.fr>
 * @version		0.1
 * @link		http://marceau.casals.fr
 */
class PHPArrayToPlist
{
	/**
	 * Tableau PHP à transformer
	 * 
	 * @var	array
	 */
	private $array;

	/**
	 * Contenu XML généré
	 * 
	 * @var	string
	 */
	private $xml = '';

	/**
	 * Constructeur de la classe
	 *
	 * @param	void
	 * @return	void
	 */
	public function __construct() { }

	/**
	 * Injecte les données à transformer en Plist
	 *
	 * @param	array	$data
	 * @return	self
	 */
	public function set($data)
	{
		$this->array = $data;

		return $this;
	}

	/**
	 * Vérifie si le tableau est associatif ou non
	 *
	 * @param	array	$array
	 * @return	bool
	 */
	public function is_assoc($array)
	{
		return (
			is_array($array)
			&& 0 !== count(array_diff_key($array, array_keys(array_keys($array))))
		);
	}

	/**
	 * Transforme le tableau self::$array en XML Valide et le place dans self::$xml
	 *
	 * @param	void
	 * @return	string
	 */
	public function xml()
	{
		$x = new XMLWriter();
		$x->openMemory();
		$x->setIndent(true);
		$x->startDocument('1.0', 'UTF-8');
		$x->writeDTD('plist', '-//Apple//DTD PLIST 1.0//EN', 'http://www.apple.com/DTDs/PropertyList-1.0.dtd');
		$x->startElement('plist');
		$x->writeAttribute('version', '1.0');

		$this->xmlWriteValue($x, $this->array);

		$x->endElement();
		$x->endDocument();

		$this->xml = $x->outputMemory();

		return $this->xml;
	}

	/**
	 * Ecrit un dictionnaire dans le flux
	 *
	 * @param XMLWriter $x
	 * @param           $dict
	 */
	private function xmlWriteDict(XMLWriter $x, &$dict)
	{
		$x->startElement('dict');

		foreach ($dict as $k => &$v)
		{
			$x->writeElement('key', $k);
			$this->xmlWriteValue($x, $v);
		}

		$x->endElement();
	}

	/**
	 * Ecrit un array dans le flux
	 *
	 * @param XMLWriter $x
	 * @param           $arr
	 */
	private function xmlWriteArray(XMLWriter $x, &$array)
	{
		$x->startElement('array');

		foreach($array as &$v)
		{
			$this->xmlWriteValue($x, $v);
		}

		$x->endElement();
	}

	/**
	 * Ecrit une valeur dans le flux
	 *
	 * @param XMLWriter $x
	 * @param           $value
	 */
	private function xmlWriteValue(XMLWriter $x, &$value)
	{
		if (is_int($value) || is_numeric($value))
		{
			$x->writeElement('integer', $value);
		}
		else if (is_float($value) || is_real($value) || is_double($value))
		{
			$x->writeElement('real', $value);
		}
		else if (is_bool($value))
		{
			$x->writeElement($value ? 'true' : 'false');
		}
		else if ($this->is_assoc($value))
		{
			$this->xmlWriteDict($x, $value);
		}
		else if (is_array($value))
		{
			$this->xmlWriteArray($x, $value);
		}
		else
		{
			$x->writeElement('string', $value);
		}
	}
}