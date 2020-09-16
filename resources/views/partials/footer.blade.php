<footer class="site__footer">
    <div class="site-footer">
        <div class="container">
            <div class="site-footer__widgets">
                <div class="row justify-content-between">
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="site-footer__widget footer-contacts">
                            <h5 class="footer-contacts__title">Contact Us</h5>
                            <div class="footer-contacts__text">Lorem ipsum dolor sit amet, consectetur
                                adipiscing elit. Integer in feugiat lorem. Pellentque ac placerat tellus.</div>
                            <ul class="footer-contacts__contacts">
                                <li><i class="footer-contacts__icon fas fa-globe-americas"></i> 715 Fake Street,
                                    New York 10021 USA</li>
                                <li><i class="footer-contacts__icon far fa-envelope"></i> stroyka@example.com
                                </li>
                                <li><i class="footer-contacts__icon fas fa-mobile-alt"></i> (800) 060-0730,
                                    (800) 060-0730</li>
                                <li><i class="footer-contacts__icon far fa-clock"></i> Mon-Sat 10:00pm - 7:00pm
                                </li>
                            </ul>
                        </div>
                    </div>
                    @if($menuItems->isNotEmpty())
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="site-footer__widget footer-links">
                            <h5 class="footer-links__title">Quick Links</h5>
                            <ul class="footer-links__list">
                                @foreach($menuItems as $item)
                                <li class="footer-links__item">
                                    <a href="{{ url($item->href) }}" class="footer-links__link">{{ $item->name }}</a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endif
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="site-footer__widget footer-newsletter">
                            <h5 class="footer-newsletter__title">Socials</h5>
                            <div class="footer-newsletter__text footer-newsletter__text--social">Follow us on
                                social networks</div>
                            <ul class="footer-newsletter__social-links">
                                <li
                                    class="footer-newsletter__social-link footer-newsletter__social-link--facebook">
                                    <a href="https://themeforest.net/user/kos9" target="_blank"><i
                                            class="fab fa-facebook-f"></i></a></li>
                                <li
                                    class="footer-newsletter__social-link footer-newsletter__social-link--twitter">
                                    <a href="https://themeforest.net/user/kos9" target="_blank"><i
                                            class="fab fa-twitter"></i></a></li>
                                <li
                                    class="footer-newsletter__social-link footer-newsletter__social-link--youtube">
                                    <a href="https://themeforest.net/user/kos9" target="_blank"><i
                                            class="fab fa-youtube"></i></a></li>
                                <li
                                    class="footer-newsletter__social-link footer-newsletter__social-link--instagram">
                                    <a href="https://themeforest.net/user/kos9" target="_blank"><i
                                            class="fab fa-instagram"></i></a></li>
                                <li class="footer-newsletter__social-link footer-newsletter__social-link--rss">
                                    <a href="https://themeforest.net/user/kos9" target="_blank"><i
                                            class="fas fa-rss"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="site-footer__bottom">
                <div class="site-footer__copyright"><a target="_blank"
                        href="https://www.templateshub.net">Templates Hub</a></div>
                <div class="site-footer__payments"><img src="{{ asset('strokya/images/payments.png') }}" alt=""></div>
            </div>
        </div>
    </div>
</footer>