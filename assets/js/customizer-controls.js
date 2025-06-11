(function($) {
    'use strict';

    // Thêm CSS cho dropdown search results
    $('<style>')
        .text(`
            .zenblog-search-results {
                position: absolute;
                z-index: 999999;
                background: white;
                border: 1px solid #ddd;
                border-radius: 4px;
                max-height: 300px;
                overflow-y: auto;
                width: 100%;
                display: none;
                margin-top: 5px;
                box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            }
            .zenblog-search-results .result-item {
                padding: 8px 12px;
                cursor: pointer;
                border-bottom: 1px solid #eee;
            }
            .zenblog-search-results .result-item:last-child {
                border-bottom: none;
            }
            .zenblog-search-results .result-item:hover {
                background: #f5f5f5;
            }
            .zenblog-search-results .no-results {
                padding: 8px 12px;
                color: #666;
                font-style: italic;
            }
            .zenblog-post-search {
                width: 100%;
            }
        `)
        .appendTo('head');

    // Khởi tạo search functionality
    wp.customize.control('featured_post_id', function(control) {
        var timer;
        var $input = control.container.find('.zenblog-post-search');
        var $results = $('<div class="zenblog-search-results"></div>').insertAfter($input);
        
        // Hiển thị tên bài viết đã chọn
        if ($input.data('selected')) {
            $input.val($input.data('selected'));
        }

        // Xử lý sự kiện input
        $input.on('input', function() {
            var searchTerm = $(this).val();
            clearTimeout(timer);

            if (searchTerm.length < 2) {
                $results.hide();
                return;
            }

            timer = setTimeout(function() {
                $.ajax({
                    url: zenblogCustomizer.ajaxurl,
                    type: 'POST',
                    data: {
                        action: 'zenblog_search_posts',
                        nonce: zenblogCustomizer.nonce,
                        search: searchTerm
                    },
                    beforeSend: function() {
                        $results.html('<div class="result-item">Searching...</div>').show();
                    },
                    success: function(response) {
                        if (response.success && response.data.length > 0) {
                            var html = '';
                            response.data.forEach(function(post) {
                                html += '<div class="result-item" data-id="' + post.id + '">' + 
                                      post.title + '</div>';
                            });
                            $results.html(html);
                        } else {
                            $results.html('<div class="no-results">No posts found</div>');
                        }
                        $results.show();
                    }
                });
            }, 300);
        });

        // Xử lý click chọn bài viết
        $results.on('click', '.result-item', function() {
            var postId = $(this).data('id');
            var postTitle = $(this).text();
            
            if (postId) {
                control.setting.set(postId);
                $input.val(postTitle);
                $results.hide();
            }
        });

        // Ẩn kết quả khi click ra ngoài
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.zenblog-post-search, .zenblog-search-results').length) {
                $results.hide();
            }
        });
    });

})(jQuery); 