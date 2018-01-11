<div class="box-footer clearfix">
   
    <ul class="pagination pagination-sm no-margin pull-right">
        <?php
            echo $this->Paginator->first('<<',array('tag' => 'li'), array('class' => 'first'));
            echo $this->Paginator->prev(__('prev'), array('tag' => 'li'), null, array('tag' => 'li', 'class' => 'disabled', 'disabledTag' => 'a'));
            echo $this->Paginator->numbers(array('separator' => '', 'currentTag' => 'a', 'currentClass' => 'active', 'tag' => 'li', 'modulus' => 4));
            echo $this->Paginator->next(__('next'), array('tag' => 'li', 'currentClass' => 'disabled'), null, array('tag' => 'li', 'class' => 'disabled', 'disabledTag' => 'a'));
            echo $this->Paginator->last('>>', array('tag' => 'li'),array('class' => 'last'));
        ?>
    </ul>
</div>