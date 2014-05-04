Yii-bootstrap3-datepicker
=========================

Datepicker using bootstrap 3

Usage
-----

```
<?php $this->widget('vendor.ikirux.yii-bootstrap3-datepicker.DatePickerControl', [
    'model' => $model,
    'attribute' => 'birth_date',
    'options' => [
        'placement' => 'right',
        'autoclose' => true,
        'todayBtn' => true,
    ]
]); ?>
```

Advance Example
---------------

```
<?php $this->widget('vendor.ikirux.yii-bootstrap3-datepicker.DatePickerControl', [
    'model' => $model,
    'attribute' => 'birth_date',
    'type' => 'embedded',
    'methods' => [
        [
            'name' => 'setDates',
            'arg1' => "'08/01/2014','09/01/2014','15/01/2014'",
        ],
    ],
    'triggerEvents' => [
        'changeDate',
    ],
    'options' => [
        'placement' => 'right',
        'autoclose' => true,
        'multidate' => true,
    ],
]); ?>
```



Resources
---------

Bootstrap-datepicker's homepage (https://github.com/eternicode/bootstrap-datepicker)

Have fun!