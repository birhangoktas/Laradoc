        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <ul class="nav">
                <li class="nav-item nav-profile">
                    <a href="#" class="nav-link">
                
                        <div class="text-wrapper">
                            <p class="profile-name">{{ Auth::guard('root')->user()->name.' '.Auth::guard('root')->user()->last }}</p>
                            <p class="designation">{{ Auth::guard('root')->user()->title }}</p>
                        </div>
                    </a>
                </li>
                <li class="nav-item nav-category">Site haritası</li>
                <li class="nav-item">
                    <a class="nav-link" href="/root">
                        <i class="menu-icon typcn typcn-document-text"></i>
                        <span class="menu-title">Ana sayfa</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                        <i class="menu-icon typcn typcn-coffee"></i>
                        <span class="menu-title">Destek talepleri</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="ui-basic">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item">
                                <a class="nav-link" href="/root/destek-talepleri"  target="_blank">Yanıtla</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/root/yanitlar">Yanıtlarım</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/root/doktorlar">
                        <i class="menu-icon typcn typcn-shopping-bag"></i>
                        <span class="menu-title">Doktorlar</span>
                    </a>
                </li>

            </ul>
        </nav>
