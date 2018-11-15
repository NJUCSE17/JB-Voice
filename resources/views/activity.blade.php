@extends('layouts.app')

@section('content')
    <div class="container">
        @include('layouts.messages')

        <h1 class="h1">
            {{ $activity->name }} ({{ count($reviews) }}/50)
        </h1>
        <hr />

        @if(count($reviews) < 50)
            <div>
                {{ html()->form('POST', route('activity.comment', [$activity->id]))->open() }}
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            {{ html()->label("你对本次活动的反馈（必填）")->for('comment') }}
                            {{ html()->textarea('comment')
                                ->class('form-control')
                                ->placeholder("不少于10个字，但也请不要超过500个字。")
                                ->attribute('rows', 3)
                                ->required() }}
                        </div><!--form-group-->
                    </div><!--col-->
                </div><!--row-->
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            {{ html()->label("你对未来活动的期待（选填）")->for('desire') }}
                            {{ html()->textarea('desire')
                                ->class('form-control')
                                ->placeholder("请不要超过500个字。")
                                ->attribute('rows', 3) }}
                        </div><!--form-group-->
                    </div><!--col-->
                </div><!--row-->
                <div class="alert alert-warning" role="alert">
                    提交按钮请只按一次，不要重复提交。反馈一旦提交，就不再可以删除和编辑。<br />
                    这个规则的设立，是为了创造一个所有人对自己说过的话更加负责的社区氛围。<br />
                    （好吧上面这句话是从V2抄来的，其实就是管理员懒得做更加复杂的功能）。<br />
                    此外，虽然有考虑如果有人故意黑服务器怎么办；但是根据小姐姐要求，不会保存学号/姓名，请放心填写。
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group form-inline">
                            {{ html()->label("学号")->for('sid')->class('mx-3') }}
                            {{ html()->input()
                                ->name('sid')
                                ->class('form-control')
                                ->required() }}
                        </div><!--form-group-->
                    </div><!--col-->
                    <div class="col">
                        <div class="form-group form-inline">
                            {{ html()->label("姓名")->for('sname')->class('mx-3') }}
                            {{ html()->input()
                                ->name('sname')
                                ->class('form-control')
                                ->required() }}
                        </div><!--form-group-->
                    </div><!--col-->
                    <div class="col">
                        {{ html()->label("我已阅读上述内容")->for('ACK')->class('mx-3') }}
                        {{ html()->checkbox("ACK")->value(0)->required() }}
                        {{ html()->submit("提交")
                            ->class('btn-success mx-3')
                            ->attribute('style', 'width:auto;') }}
                    </div><!--col-->
                </div><!--row-->
                {{ html()->form()->close() }}
            </div>
        @else
            <p class="text-center">活动反馈名额已满，谢谢您对我们工作的关注与支持。</p>
        @endif
        <hr />

        @foreach($reviews as $review)
            <div class="card mb-3">
                <div class="card-header">
                    网友{{$review->id}}
                </div>
                <div class="card-body">
                    {!! $review->comment !!}
                    @if(!empty($review->desire))
                        <hr />
                        {!! $review->desire !!}
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endsection