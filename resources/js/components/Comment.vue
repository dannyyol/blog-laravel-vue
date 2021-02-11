<template>
    <div class="comment-wrapper">
        <div class="card">
            <div class="card-header bg-light">
                Comment panel
            </div>
            <div class="card-body">
                <textarea class="form-control" placeholder="write a comment..." rows="3"></textarea>
                <br>
                <button type="button" class="btn btn-info pull-right">Post</button>
                <div class="clearfix"></div>
                <hr>
                <ul class="media-list">
                    <li class="media">
                        <a href="#" class="pull-left">
                            <img src="https://bootdey.com/img/Content/user_1.jpg" alt="" class="img-circle">
                        </a>
                        <div class="media-body">
                            <span class="text-muted pull-right">
                                <small class="text-muted">30 min ago</small>
                            </span>
                            <strong class="text-success">@MartinoMont</strong>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                Lorem ipsum dolor sit amet, <a href="#">#consecteturadipiscing </a>.
                            </p>
                        </div>
                    </li>
                    <li class="media">
                        <a href="#" class="pull-left"  style="padding-right:10px;">
                            <img src="https://bootdey.com/img/Content/user_2.jpg" alt="" class="img-circle">
                        </a>
                        <div class="media-body">
                            <span class="text-muted pull-right">
                                <small class="text-muted">30 min ago</small>
                            </span>
                            <strong class="text-success">@LaurenceCorreil</strong>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                Lorem ipsum dolor <a href="#">#ipsumdolor </a>adipiscing elit.
                            </p>
                        </div>
                    </li>
                    <li class="media">
                        <a href="#" class="pull-left">
                            <img src="https://bootdey.com/img/Content/user_3.jpg" alt="" class="img-circle">
                        </a>
                        <div class="media-body">
                            <span class="text-muted pull-right">
                                <small class="text-muted">30 min ago</small>
                            </span>
                            <strong class="text-success">@JohnNida</strong>
                            <p>
                                Lorem ipsum dolor <a href="#">#sitamet</a> sit amet, consectetur adipiscing elit.
                            </p>
                        </div>
                    </li>
                    <!-- added -->
                    <li class="media" v-for="comment in comments">
                        <a href="#" class="pull-left">
                            <img src="https://bootdey.com/img/Content/user_3.jpg" alt="" class="img-circle">
                        </a>
                        <div class="media-body">
                            <span class="text-muted pull-right">
                                <small class="text-muted">30 min ago</small>
                            </span>
                            <strong class="text-success">@JohnNida</strong>
                            <p v-text="comment.body">
                                Lorem ipsum dolor <a href="#">#sitamet</a> sit amet, consectetur adipiscing elit.
                            </p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>

</script>