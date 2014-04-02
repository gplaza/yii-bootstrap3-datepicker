<?php
/**
 * DatePickerControl widget class
 *
 * @author: Carlos Pinto <ikirux@gmail.com>
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 *
 */
class DatePickerControl extends CInputWidget
{
	/**
	 * @var array the options for the Bootstrap JavaScript plugin.
	 */
	public $options = [];

	/**
	 * @var string[] the JavaScript event handlers.
	 */
	public $events = [];

	/**
	 * Initializes the widget.
	 */
	public function init()
	{
		$this->htmlOptions['type'] = 'text';
		$this->htmlOptions['autocomplete'] = 'off';

		if (!isset($this->options['language'])) {
			$this->options['language'] = Yii::app()->language;
		}

		if (!isset($this->options['format'])) {
			if (!Yii::app()->locale->dateFormat) {
				$this->options['format'] = 'yyyy/mm/dd';
			} else {
				$this->options['format'] = strtolower(Yii::app()->locale->dateFormat);
			}
		} 
		
		if (!isset($this->options['weekStart'])) {
			$this->options['weekStart'] = 0; // Sunday
		}
	}

	/**
	 * Runs the widget.
	 */
	public function run()
	{
		list($name, $id) = $this->resolveNameID();

		if ($this->hasModel()) {
			echo BsHtml::activeTextFieldControlGroup($this->model, $this->attribute, $this->htmlOptions);
		} else {
			echo BsHtml::activeTextFieldControlGroup($name, $this->value, $this->htmlOptions);
		}

		$this->registerClientScript($id);
	}

	/**
	 * Registers required client script for bootstrap datepicker. It is not used through bootstrap->registerPlugin
	 * in order to attach events if any
	 */
	public function registerClientScript($id)
	{
		$baseScriptUrl = Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('ven.ikirux.yii-bootstrap3-datepicker.assets'));

		$cs = Yii::app()->getClientScript();
		$cs->registerCssFile($baseScriptUrl . '/css/datepicker3.css');
		$cs->registerScriptFile($baseScriptUrl . '/js/bootstrap-datepicker.js', CClientScript::POS_END);

		$options = !empty($this->options) ? CJavaScript::encode($this->options) : '';

		ob_start();
		echo "jQuery('#{$id}').datepicker({$options})";
		foreach ($this->events as $event => $handler) {
			echo ".on('{$event}', " . CJavaScript::encode($handler) . ")";
		}

		Yii::app()->getClientScript()->registerScript(__CLASS__ . '#' . $this->getId(), ob_get_clean() . ';');
	}
}