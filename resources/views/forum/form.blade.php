<div id="discussion-title" class="form-group">
    {!! Form::label('title', '标题') !!}
    {!! Form::text('title', null, ['class' => 'form-control', 'v-model' => 'title']) !!}
    {!! Form::hidden('slug', null, ['v-model' => 'translation']) !!}
</div>
<div class="form-group">
    <label for="body">内容</label>
    {!! Form::textarea('body', null, [
            'rows' => '20',
            'class' => 'form-control',
            'id' => 'simplemde-editor',
            'style' => 'resize: vertical; overflow: auto;',
    ]) !!}
</div>
<div class="form-group">
    {!! Form::label('categories', '分类') !!}
    {!! Form::select('categories[]', $categories, null, ['class' => "categories form-control", 'multiple' => 'multiple']) !!}
</div>