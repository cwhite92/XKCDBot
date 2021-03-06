@extends('layouts.main')

@section('content')
    <div class="intro">
        <h1>There is always a relevant XKCD.</h1>
        <h2>Now you can get relevant XKCDs in your Slack team.</h2>
        <a href="https://slack.com/oauth/authorize?scope=commands&client_id=35162881508.35386565014"><img alt="Add to Slack" height="40" width="139" src="https://platform.slack-edge.com/img/add_to_slack.png" srcset="https://platform.slack-edge.com/img/add_to_slack.png 1x, https://platform.slack-edge.com/img/add_to_slack@2x.png 2x" /></a>
    </div>

    <img src="/img/screenshot.png" class="preview" alt="XKCD Slack bot preview">
@endsection
