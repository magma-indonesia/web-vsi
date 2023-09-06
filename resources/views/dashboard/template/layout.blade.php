<!DOCTYPE html>
<html lang="id">
@include('dashboard.template.head')
<body>
<div id="app">
    @include('dashboard.template.sidebar')
    @include($contents)
</div>
@include('dashboard.template.script')
</body>
</html>
