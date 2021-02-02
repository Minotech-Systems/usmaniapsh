
<section  class="clearfix d-lg-none" style="background: #53516b; color: white;">
    <div class="container ">
        <div class="row ">

            <div class="col-md-12 col-sm-12 col-xs-12 ">
                <center>

                    <h2 style="" class="arabic" id="head_start"><?= 'بِسْمِ اللَّهِ الرَّحْمَنِ الرَّحِيم' ?></h2>

                </center>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="row">
                    <table width="95%" dir="rtl" style="color:white" align="center" id="mobile_head">
                        <tr>
                            <?php if ($this->session->userdata('user_login') == 1) { ?>
                                <td width="30%" align="right">
                                    <a href="<?= base_url('login') ?>" class=" top_mobile_links"><?= $this->session->userdata('name') ?></a>
                                </td>
                            <?php } else { ?>
                                <td width="30%" align="right">
                                    <a href="<?= base_url('login') ?>" class=" top_mobile_links">لاگ ان</a>
                                </td>
                            <?php } ?>
                            <td width="40%" align="center">
                                <?= date('d/m/Y') ?>
                            </td>

                            <td width="30%" align="left">
                                <select  style="background: #7b654d; border: none" onchange="change_lang(this.value)">
                                    <option value="english"<?php if ($lang == 'english') echo 'selected'; ?>>English</option>
                                    <option value="urdu" <?php if ($lang == 'urdu') echo 'selected'; ?>>اردو</option>
                                </select>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="inner-banner " >
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-6 col-xs-6">
                <h2 style="float:right; margin-top: 30px" id="ifta_h2">العصر</h2>
            </div>
            <div class="col-sm-6 col-md-6 col-xs-6">
                <div class="right-heading">
                    <img src="<?= base_url('uploads/header.png') ?>" width="60%">
                </div>
            </div>
        </div>
    </div>
</section>