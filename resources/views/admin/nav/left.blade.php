        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <ul class="nav">
                <li class="nav-item nav-profile">
                    <a href="#" class="nav-link">
                        <div class="profile-image">
                            <img class="img-xs rounded-circle" src="/userprofil/{{Auth()->user()->profil}}" alt="profile image">
                            <div class="dot-indicator bg-success"></div>
                        </div>
                        <div class="text-wrapper">
                            <p class="profile-name">{{ Auth()->user()->name.' '.Auth()->user()->last }}</p>
                            <p class="designation">{{ Auth()->user()->email }}</p>
                        </div>
                    </a>
                </li>
                <li class="nav-item nav-category">Site haritası</li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin">
                        <i class="menu-icon typcn typcn-document-text"></i>
                        <span class="menu-title">Ana sayfa</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/admin/islem-gecmisi">
                        <i class="menu-icon typcn typcn-shopping-bag"></i>
                        <span class="menu-title">İşlem geçmişim</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                        <i class="menu-icon typcn typcn-coffee"></i>
                        <span class="menu-title">Geri bildirim oluştur</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="ui-basic">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item">
                                <a class="nav-link" href="/admin/destek-talebi">Destek oluştur</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/admin/destek-talebim">Desteklerim</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/admin/ayarlar">
                        <i class="menu-icon typcn typcn-th-large-outline"></i>
                        <span class="menu-title">Ayarlar</span>
                    </a>
                </li>
            </ul>
        </nav>
