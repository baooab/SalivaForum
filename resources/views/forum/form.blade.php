<div id="discussion-title" class="form-group">
    {!! Form::label('title', '标题') !!}
    {!! Form::text('title', null, ['class' => 'form-control', 'v-model' => 'title']) !!}
    {!! Form::hidden('slug', null, ['v-model' => 'translation']) !!}
</div>
<div class="form-group">
    {!! Form::label('body', '内容') !!}
    {!! Form::textarea('body', null, [
            'rows' => '20',
            'class' => 'form-control',
            'style' => 'resize: vertical; overflow: auto;',
            'placeholder' => '支持Markdown格式'
    ]) !!}
</div>
<div class="form-group">
    {!! Form::label('categories', '分类') !!}
    {!! Form::select('categories[]', $categories, null, ['class' => "categories form-control", 'multiple' => 'multiple']) !!}
</div>