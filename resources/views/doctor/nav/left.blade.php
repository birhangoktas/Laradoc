        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <ul class="nav">
                <li class="nav-item nav-profile">
                    <a href="#" class="nav-link">
                        <div class="profile-image">
                            <img class="img-xs rounded-circle" src="/profil/{{Auth::guard('doctor')->user()->profil}}" alt="profile image">
                            <div class="dot-indicator bg-success"></div>
                        </div>
                        <div class="text-wrapper">
                            <p class="profile-name">{{ Auth::guard('doctor')->user()->name.' '.Auth::guard('doctor')->user()->last }}</p>
                            <p class="designation">{{ Auth::guard('doctor')->user()->title }}</p>
                        </div>
                    </a>
                </li>
                <li class="nav-item nav-category">Site haritası</li>
                <li class="nav-item">
                    <a class="nav-link" href="/dr">
                        <i class="menu-icon typcn typcn-document-text"></i>
                        <span class="menu-title">Ana sayfa</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                        <i class="menu-icon typcn typcn-coffee"></i>
                        <span class="menu-title">Hizmet oluştur</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="ui-basic">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item">
                                <a class="nav-link" href="/dr/ilan-olustur">Doktor sayfası</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/dr/kazanclarim">Kazançlarım</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/dr/islem-gecmisi">
                        <i class="menu-icon typcn typcn-shopping-bag"></i>
                        <span class="menu-title">İşlem geçmişim</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/dr/ayarlar">
                        <i class="menu-icon typcn typcn-th-large-outline"></i>
                        <span class="menu-title">Ayarlar</span>
                    </a>
                </li>
            </ul>
        </nav>
