@if(Auth::check())
  @if(auth()->user()->admin)
  <div class="admin_panel center-align">
    <ul>
      <li><a href="/users" class="tooltipped" data-position="right" data-tooltip="{{ __('admin.user_mngm_tool') }}"><i class="material-icons admin_icon">person</i></a></li>
      <li><a href="/reviews/create" class="tooltipped" data-position="right" data-tooltip="{{ __('admin.create_review_tool') }}"><i class="material-icons admin_icon">album</i></a></li>
      <li><a href="/blog/create" class="tooltipped" data-position="right" data-tooltip="{{ __('admin.create_blog_tool') }}"><i class="material-icons admin_icon">insert_drive_file</i></a></li>
      <li><a href="/genres/create" class="tooltipped" data-position="right" data-tooltip="{{ __('admin.mng_tag_genre_tool') }}"><i class="material-icons admin_icon">local_offer</i></a></li>
    </ul>
    <a href="#" class="toggleAdmin" id="toggleAdmin"><i class="material-icons">code</i></a>
  </div>
  @endif
@endif
