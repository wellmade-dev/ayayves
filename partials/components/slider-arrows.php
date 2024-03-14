<?php 
$mobile_attr = $args['is_mobile'] ? 'true' : 'false'; 
$bottom_attr = $args['is_bottom'] ? 'bottom-mounted' : '';
?>
<div class="swiper-arrow-w <?php echo esc_attr($bottom_attr); ?>" mobile="<?php echo esc_attr($mobile_attr); ?>">
    <a class="button--arrow swiper-prev"> <div class="arrow-w">
            <svg width="2.25rem" height="100%" viewBox="0 0 36 14" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio transform:="rotate(0deg)" class="arrow">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M4.46458 7.94931L9.01045 12.4804C9.10846 12.5781 9.10846 12.7368 9.01045 12.8345L8.01767 13.8241C7.92011 13.9213 7.76226 13.9213 7.66469 13.8241L0.996001 7.17706C0.897986 7.07937 0.897986 6.92063 0.996001 6.82294L7.66469 0.175915C7.76226 0.0786674 7.92011 0.0786675 8.01767 0.175915L9.01045 1.16546C9.10846 1.26316 9.10846 1.4219 9.01045 1.51959L4.46458 6.05069H34.932C35.0701 6.05069 35.182 6.16262 35.182 6.30069V7.69931C35.182 7.83738 35.0701 7.94931 34.932 7.94931H4.46458Z" fill="currentColor"/>
            </svg>
            <svg width="2.25rem" height="100%" viewBox="0 0 36 14" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio transform:="rotate(0deg)" class="arrow is--outer-prev">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M4.46458 7.94931L9.01045 12.4804C9.10846 12.5781 9.10846 12.7368 9.01045 12.8345L8.01767 13.8241C7.92011 13.9213 7.76226 13.9213 7.66469 13.8241L0.996001 7.17706C0.897986 7.07937 0.897986 6.92063 0.996001 6.82294L7.66469 0.175915C7.76226 0.0786674 7.92011 0.0786675 8.01767 0.175915L9.01045 1.16546C9.10846 1.26316 9.10846 1.4219 9.01045 1.51959L4.46458 6.05069H34.932C35.0701 6.05069 35.182 6.16262 35.182 6.30069V7.69931C35.182 7.83738 35.0701 7.94931 34.932 7.94931H4.46458Z" fill="currentColor"/>
            </svg>
        </div> </a><a class="button--arrow swiper-next"> <div class="arrow-w">
            <svg width="2.25rem" height="100%" viewBox="0 0 36 14" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio transform:="rotate(0deg)" class="arrow is--flipped">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M4.46458 7.94931L9.01045 12.4804C9.10846 12.5781 9.10846 12.7368 9.01045 12.8345L8.01767 13.8241C7.92011 13.9213 7.76226 13.9213 7.66469 13.8241L0.996001 7.17706C0.897986 7.07937 0.897986 6.92063 0.996001 6.82294L7.66469 0.175915C7.76226 0.0786674 7.92011 0.0786675 8.01767 0.175915L9.01045 1.16546C9.10846 1.26316 9.10846 1.4219 9.01045 1.51959L4.46458 6.05069H34.932C35.0701 6.05069 35.182 6.16262 35.182 6.30069V7.69931C35.182 7.83738 35.0701 7.94931 34.932 7.94931H4.46458Z" fill="currentColor"/>
            </svg>
            <svg width="2.25rem" height="100%" viewBox="0 0 36 14" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio transform:="rotate(0deg)" class="arrow is--flipped is--outer-next">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M4.46458 7.94931L9.01045 12.4804C9.10846 12.5781 9.10846 12.7368 9.01045 12.8345L8.01767 13.8241C7.92011 13.9213 7.76226 13.9213 7.66469 13.8241L0.996001 7.17706C0.897986 7.07937 0.897986 6.92063 0.996001 6.82294L7.66469 0.175915C7.76226 0.0786674 7.92011 0.0786675 8.01767 0.175915L9.01045 1.16546C9.10846 1.26316 9.10846 1.4219 9.01045 1.51959L4.46458 6.05069H34.932C35.0701 6.05069 35.182 6.16262 35.182 6.30069V7.69931C35.182 7.83738 35.0701 7.94931 34.932 7.94931H4.46458Z" fill="currentColor"/>
            </svg>
        </div>
    </a>
</div>