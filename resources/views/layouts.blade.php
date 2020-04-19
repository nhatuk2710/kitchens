<!DOCTYPE html>
<html lang="zxx">

@includeIf('html.head')

<body>
<!-- Page Preloder -->

<!-- Header Section Begin -->
@includeIf('html.header')
<!-- Header End -->

<!-- Hero Section Begin -->
@yield('banner')

@yield('extra')
<!-- Hero Section End -->

@includeIf('html.footer')
<!-- Footer Section End -->

<!-- Js Plugins -->
@includeIf('html.script')
</body>

</html>
