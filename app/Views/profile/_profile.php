<div class="profile-sidebar position-fixed">

	<div class="profile-userpic">
		<a href="/profile" class="pull-right"><img title="profile image" class="img-circle img-responsive" src="/images/user.png"></a>
	</div>


	<div class="profile-usertitle">
		<div class="profile-usertitle-name">
		<?= $user->name;?>
		</div>
		<div class="profile-usertitle-job">
		Developer
		</div>
	</div>

	<div class="profile-usermenu sidebar-sticky">
		<ul class="nav flex-column">
			<li class="active nav-item">
			<a href="/admin" class="nav-link active">
			<i class="fa fa-home"></i>
			Admin Panel </a>
			</li>
			<li class="nav-item">
			<a class="nav-link" href="/profile">
			<i class="fa fa-user"></i>
			Settings </a>
			</li>
			<li class="nav-item">
			<a class="nav-link" href="#">
			<i class="fa fa-check"></i>
			Tasks </a>
			</li>
			<li class="nav-item">
			<a class="nav-link" href="/profile/orders">
			<i class="fa fa-flag"></i>
			Orders </a>
			</li>
		</ul>
	</div>

</div>