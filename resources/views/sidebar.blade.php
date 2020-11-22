<!-- Wrapper -->
<div class="wrapper" style="background-color:gray">
    <nav class="sidebar">
        <!-- open sidebar menu -->
        <a class="btn btn-primary btn-customized open-menu" style="margin-top: 60px" href="#" role="button">
            <i class="fas fa-align-left"></i> <span>Menu</span>
        </a>
        <ul class="list-unstyled menu-elements">
            <li class="active">
                <a class="scroll-link" href="#top-content"><i class="fas fa-home"></i> My Profile</a>
            </li>

            <li>
                <a class="scroll-link" href="#section-6"><i class="fas fa-envelope"></i> Contact us</a>
            </li>
            <li>
                <a href="#otherSections" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"
                role="button" aria-controls="otherSections">
                    <i class="fab fa-buffer"></i>Meme categories
                </a>
                <ul class="collapse list-unstyled" id="otherSections">
                    @if (!empty($categories))
                        @foreach($categories as $category)
                            <li>
                                <a
                                    href="{{url(route('filter.category', $category->id))}}">{{$category->name}}</a>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </li>
            <!-- close sidebar menu -->
            <div style="display: flex; justify-content: center;">
                <div class="dismiss">
                    <i class="fas fa-arrow-left"></i>
                </div>
            </div>
        </ul>
    </nav>
    <!-- End sidebar -->

    <!-- Dark overlay -->
    <div class="overlay"></div>
</div>