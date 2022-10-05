<div class="container mg-box container-box">
    <?php
        $post_data = $db->selectData("tbl_news 
        INNER JOIN tbl_menu on tbl_menu.id = 1","tbl_news.id,tbl_news.post_date,tbl_news.title,tbl_news.img,tbl_news.des,tbl_menu.name,
        tbl_news.mid","tbl_news.location=1 && tbl_news.status=1","tbl_news.od DESC",0,9);
        $left_box = '<a href="" class="left-box">'.
                        '<div class="img-box">'.
                            '<div class="cover-img">'.
                                '<div class="img bg-img" style="background-image: url("http://localhost/Sabay Project/Admin/images/1655654210699947.jpg");">'.
                                '</div>'.
                            '</div>'.
                        '</div>'.
                        '<div class="txt-box" style="background-color: #FA5480;">'.
                            '<h3>ក្រុមហ៊ុន ហនុមាន ប៊ែវើរីជីស ឯ.ក ប្រគល់រង្វាន់ម៉ូតូកង់បី ចំនួន៩គ្រឿងដល់ដៃគូចែកចាយបន្តរបស់ខ្លួន</h3>'.
                        '</div>'.
                    '</a>';
        $i=1;
        foreach($post_data as $row){
        }
    ?>
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="main-header">
                <div class="header" style="background-color: #FA5480 ;">
                    <h3>កម្សាន្ត <i class="fa-solid fa-chevron-right"></i></h3>
                </div>
            </div>
            <div class="main-box-category" style="border-top: 3px solid #FA5480;">
                <div class="btn-next" style="color:#FA5480"><i class="fa-solid fa-chevron-right"></i></div>
                <!-- left-box -->
                <?php // echo $left_box; ?>
                <div class="left-box">
                    <div class="img-box">
                        <div class="cover-img">
                            <div class="img bg-img" style="background-image: url('http://localhost/Sabay Project/Admin/images/1655654210699947.jpg');">
                            </div>
                        </div>
                    </div>
                    <div class="txt-box" style="background-color: #4390F8;">
                        <h3>ក្រុមហ៊ុន ហនុមាន ប៊ែវើរីជីស ឯ.ក ប្រគល់រង្វាន់ម៉ូតូកង់បី ចំនួន៩គ្រឿងដល់ដៃគូចែកចាយបន្តរបស់ខ្លួន</h3>
                    </div>
                </div>
                <div class="right-box">
                    <div class="right-box-row">
                        <div class="wrap">
                            <div class="img-box">
                                <div class="cover-img">
                                    <div class="img bg-img" style="background-image: url('http://localhost/Sabay Project/Admin/images/1655654210699947.jpg');">
                                    </div>
                                </div>
                            </div>
                            <div class="txt-box">
                                <h2>គ្រូ Man Utd ​៖​យើង​មិន​ត្រូវ​គិត​ល្អ​ច្រើន​ពេក​ទេ ចំពោះ​ការឈ្នះ</h2>
                            </div>
                        </div>
                        <div class="wrap">
                            <div class="img-box">
                                <div class="cover-img">
                                    <div class="img bg-img" style="background-image: url('http://localhost/Sabay Project/Admin/images/1655654210699947.jpg');">
                                    </div>
                                </div>
                            </div>
                            <div class="txt-box">
                                <h2>គ្រូ Man Utd ​៖​យើង​មិន​ត្រូវ​គិត​ល្អ​ច្រើន​ពេក​ទេ ចំពោះ​ការឈ្នះ</h2>
                            </div>
                        </div>
                        <div class="wrap">
                            <div class="img-box">
                                <div class="cover-img">
                                    <div class="img bg-img" style="background-image: url('http://localhost/Sabay Project/Admin/images/1655654210699947.jpg');">
                                    </div>
                                </div>
                            </div>
                            <div class="txt-box">
                                <h2>គ្រូ Man Utd ​៖​យើង​មិន​ត្រូវ​គិត​ល្អ​ច្រើន​ពេក​ទេ ចំពោះ​ការឈ្នះ</h2>
                            </div>
                        </div>
                        <div class="wrap">
                            <div class="img-box">
                                <div class="cover-img">
                                    <div class="img bg-img" style="background-image: url('http://localhost/Sabay Project/Admin/images/1655654210699947.jpg');">
                                    </div>
                                </div>
                            </div>
                            <div class="txt-box">
                                <h2>គ្រូ Man Utd ​៖​យើង​មិន​ត្រូវ​គិត​ល្អ​ច្រើន​ពេក​ទេ ចំពោះ​ការឈ្នះ</h2>
                            </div>
                        </div>
                    </div>
                    <div class="right-box-row">
                        <div class="wrap">
                            <div class="img-box">
                                <div class="cover-img">
                                    <div class="img bg-img" style="background-image: url('http://localhost/Sabay Project/Admin/images/1655654210699947.jpg');">
                                    </div>
                                </div>
                            </div>
                            <div class="txt-box">
                                <h2>គ្រូ Man Utd ​៖​យើង​មិន​ត្រូវ​គិត​ល្អ​ច្រើន​ពេក​ទេ ចំពោះ​ការឈ្នះ</h2>
                            </div>
                        </div>
                        <div class="wrap">
                            <div class="img-box">
                                <div class="cover-img">
                                    <div class="img bg-img" style="background-image: url('http://localhost/Sabay Project/Admin/images/1655654210699947.jpg');">
                                    </div>
                                </div>
                            </div>
                            <div class="txt-box">
                                <h2>គ្រូ Man Utd ​៖​យើង​មិន​ត្រូវ​គិត​ល្អ​ច្រើន​ពេក​ទេ ចំពោះ​ការឈ្នះ</h2>
                            </div>
                        </div>
                        <div class="wrap">
                            <div class="img-box">
                                <div class="cover-img">
                                    <div class="img bg-img" style="background-image: url('http://localhost/Sabay Project/Admin/images/1655654210699947.jpg');">
                                    </div>
                                </div>
                            </div>
                            <div class="txt-box">
                                <h2>គ្រូ Man Utd ​៖​យើង​មិន​ត្រូវ​គិត​ល្អ​ច្រើន​ពេក​ទេ ចំពោះ​ការឈ្នះ</h2>
                            </div>
                        </div>
                        <div class="wrap">
                            <div class="img-box">
                                <div class="cover-img">
                                    <div class="img bg-img" style="background-image: url('http://localhost/Sabay Project/Admin/images/1655654210699947.jpg');">
                                    </div>
                                </div>
                            </div>
                            <div class="txt-box">
                                <h2>គ្រូ Man Utd ​៖​យើង​មិន​ត្រូវ​គិត​ល្អ​ច្រើន​ពេក​ទេ ចំពោះ​ការឈ្នះ</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>