<div id="discussion-title" class="form-group">
    {!! Form::label('title', '标题') !!}
    {!! Form::text('title', null, ['class' => 'form-control', 'v-model' => 'title']) !!}
    {!! Form::hidden('slug', null, ['v-model' => 'translation']) !!}
</div>
<div class="form-group">
    <label for="body">内容
        <small style="display: inline-block; margin-left: .2rem;">
            <a href="https://help.github.com/articles/basic-writing-and-formatting-syntax/" target="_blank">Markdown 怎么写？</a>
        </small>
    </label>
    {!! Form::textarea('body', null, [
            'rows' => '20',
            'class' => 'form-control',
            'style' => 'resize: vertical; overflow: auto;',
            'placeholder' => '## 大标题

一些总括说明，具体看[百度](https://baidu.com)。

### 小标题

小标题下的内容，的吧嘚吧嘚……

![这是一张图片](http://eample.com/foo.jpg)

总的来说，我分一下几点讲：

1. 第一点是……
2. 第二点是……
3. 第三点是……

我还想说点啥，但因为都是**废话**（这是重点），在这里都省略了。'
    ]) !!}
</div>
<div class="form-group">
    {!! Form::label('categories', '分类') !!}
    {!! Form::select('categories[]', $categories, null, ['class' => "categories form-control", 'multiple' => 'multiple']) !!}
</div>