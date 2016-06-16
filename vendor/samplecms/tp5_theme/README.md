# tp5_theme

安装  `composer require samplecms/tp5_theme:dev-master`


事例

		<?php
		namespace app\index\controller;
		use tp\theme\Theme;
		class Index extends Theme
		{
			public $theme = 'default';
		    public function index()
		    {
		    	

		       
		       return  $this->make('index');
		    }
		}



主题对应文件 `public/themes/default/index/index/index.html`