<?php

class Helper {
    
    public static function flashMessage($text)
    { ?>
        <script>
            window.onload = () => {
                const newEl = document.createElement('div');
                const elBefore = document.querySelector('.game-rules-wrapper');
                const textNode = document.createTextNode('<?php echo $text; ?>');
                
                newEl.appendChild(textNode);
                newEl.setAttribute('class', 'showMessage');
                elBefore.insertBefore(newEl, elBefore.childNodes[0]);
                
                setInterval(() => {
                    newEl.classList.add('d-none');
                }, 5000);
            }
        </script>
    <?php }
    
    public static function redirect($path)
    {
        header("Location: {$path}");
    }
    
}