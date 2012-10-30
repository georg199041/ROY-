<div style="color:#000; margin:10px; padding:10px; border:1px dotted #000;">
    <div style="font-size:20px; font-weight:bold;">An error occurred</div>
    <div style="font-size:18px;"><?php echo $this->message ?></div>
	<?php if (isset($this->exception)): ?>
	<div style="padding:10px 0 0;">
    	<div style="font-size:18px; font-weight:bold;">Detailed exception information:</div>
        <div style="padding:0 0 0 10px;">
            <div style="font-size:16px; font-weight:bold; padding:0 0 15px;">
            	Message: <span style="font-size:14px; font-weight:normal;"><?php echo $this->exception->getMessage() ?></span><br />
            	In: <span style="font-size:14px; font-weight:normal;"><?php echo $this->exception->getFile() ?></span><br />
            	On line: <span style="font-size:14px; font-weight:normal;"><?php echo $this->exception->getLine() ?></span>
            </div>
            <div style="font-size:14px; padding:0 0 15px;">
            	<div style="font-size:16px; font-weight:bold;">Stack trace:</div>
	            <ol style="padding:0 0 0 30px; margin:0;"><?php
					$strArray = explode( '<br />', nl2br( $this->exception->getTraceAsString() ) );
					foreach ($strArray as $str) {
						$pos1 = stripos($str, ' ');
						$pos2 = stripos($str, ': ');
						if ($pos2 !== false) {
							$file = substr($str, $pos1, $pos2-$pos1);
							$class = substr($str, $pos2+1)
							?><li style="padding:3px 0;"><?php echo $class ?>
								<div style="font-size:12px;"><?php echo $file ?></div>
							</li><?php
						} else {
							$class = substr($str, $pos1)
							?><li style="padding:3px 0;"><?php echo $class ?></li><?php
						}
					}
					//echo nl2br($this->exception->getTraceAsString());
				?></ol>
            </div>
            <div style="font-size:16px; font-weight:bold; padding:0 0 15px;">Request Parameters: route "<?php echo Zend_Controller_Front:: getInstance()->getRouter()->getCurrentRouteName(); ?>"
                <pre style="font-size:12px; font-family:'Open Sans'; font-weight:normal; margin:0 0 0 10px;"><?php echo var_export($this->request->getParams(), true) ?></pre>
            </div>
            <div style="font-size:16px; font-weight:bold;">Database data:
                <?php foreach ($this->profilers as $name => $profiler): ?>
                <div style="font-size:14px; font-weight:normal">Adapter: <b><?php echo $name; ?></b></div>
                <div style="font-size:14px; font-weight:normal">Query:
                <?php if (($queries = $profiler->getQueryProfiles())): ?>
                <?php foreach ($queries as $query): ?>
                <div><?php echo $query->getQuery(); ?></div>
                <?php endforeach; ?>
                <div><?php echo $profiler->getLastQueryProfile()->getQuery(); ?></div>
                <?php else: ?>
                (Empty)
                <?php endif; ?>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php endif ?>
</div>