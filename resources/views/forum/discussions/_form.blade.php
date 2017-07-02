<div id="discussion-title" class="form-group">
    {!! Form::label('title', '标题') !!}
    {!! Form::text('title', old('title'), ['class' => 'form-control', 'v-model' => 'title']) !!}
    {!! Form::hidden('slug', old('slug'), ['v-model' => 'translation']) !!}
</div>
<div class="form-group">
    <label for="body">内容</label>
    {!! Form::textarea('body', old('body'), [
            'rows' => '20',
            'class' => 'form-control',
            'id' => 'simplemde-editor',
            'style' => 'resize: vertical; overflow: auto;',
    ]) !!}
</div>
<div class="form-group">
    {!! Form::label('categories', '分类') !!}
    {!! Form::select('categories[]', $categories, old('categories'), ['class' => "categories form-control", 'multiple' => 'multiple']) !!}
</div>