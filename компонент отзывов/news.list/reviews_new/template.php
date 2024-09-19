<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?$this->setFrameMode(true);?>

<div class="review">
	<?if($arResult["ITEMS"]){?>
		<div class="review__top">
			<div class="review__title">Отзывы (<?=count($arResult['ITEMS'])?>)</div>
			<a class="review__link js-add-review d-md-none" data-fancybox="" data-src="#review-form" href="javascript:;">Оставить отзыв</a>

			<div class="review__action">
				<?
				$sumScore = 0;
				$countScore = 0;
				
				foreach($arResult["ITEMS"] as $arItem){
					if($arItem['PROPERTIES']['RATING']['VALUE']){
						$countScore++;
						$sumScore = $sumScore + $arItem['PROPERTIES']['RATING']['VALUE'];
					}
				}

				$ratingResult = round($sumScore/$countScore, 1);
				$ratingResultPr = round($ratingResult * 100/5, 1);
				?>
				<?
				global $USER;
				if ($USER->IsAdmin())
				{
				// echo "<pre>"; print_r($sumScore); echo "</pre>";
				}
				?>
				<div class="rating-wrap">
					<div class="rating rating_big">
						<div class="rating__content" style="width: <?=$ratingResultPr?>%;"></div>
					</div>
					<div class="rating-wrap__num"><?=$ratingResult?>/5</div>
				</div>
				
				<a class="review__link js-add-review d-none d-md-inline-block" data-fancybox="" data-src="#review-form" href="javascript:;">Оставить отзыв</a>
			</div>
		</div>

		<div class="review__list">
			<?foreach($arResult["ITEMS"] as $arItem):?>
				<?
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				?>

				<div class="review-item js-review-item">
					<div class="review-item__top">
						<div class="review-item__info">
							<?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]){?>
								<div class="review-item__author"><?=$arItem["NAME"]?></div>
							<?}?>

							<?if($arItem["DISPLAY_ACTIVE_FROM"]){?>
								<div class="review-item__date"><?=$arItem["DISPLAY_ACTIVE_FROM"]?></div>
							<?}?>

							<?
							global $USER;
							if ($USER->IsAdmin())
							{
							// echo "<pre>"; print_r($arItem); echo "</pre>";
							}
							?>
							<?if($arItem['PROPERTIES']['RATING']['VALUE']){
								$rating = $arItem['PROPERTIES']['RATING']['VALUE'] * 100 / 5;
							} else {
								$rating = 0;
							}?>

							<div class="rating rating_big d-none d-md-inline-block">
								<div class="rating__content js-review-rating" style="width: <?=$rating?>%;" data-rating="<?=$arItem['PROPERTIES']['RATING']['VALUE']?>"></div>
							</div>
						</div>
					</div>

					<div class="review-item__content">
						<?if($arItem['PROPERTIES']['ADVANTAGE']['VALUE']['TEXT']){?>
							<div class="review-item__label"><?=$arItem['PROPERTIES']['ADVANTAGE']['NAME']?>:</div>
							<p class="js-review-advant"><?=$arItem['PROPERTIES']['ADVANTAGE']['VALUE']['TEXT']?></p>
						<?}?>
						
						<?if($arItem['PROPERTIES']['DISADVANTAGE']['VALUE']['TEXT']){?>
							<div class="review-item__label"><?=$arItem['PROPERTIES']['DISADVANTAGE']['NAME']?>:</div>
							<p class="js-review-disadvant"><?=$arItem['PROPERTIES']['DISADVANTAGE']['VALUE']['TEXT']?></p>
						<?}?>

						<?if($arItem['PROPERTIES']['COMMENTS']['VALUE']['TEXT']){?>
							<div class="review-item__label"><?=$arItem['PROPERTIES']['COMMENTS']['NAME']?>:</div>
							<p class="js-review-comment"><?=$arItem['PROPERTIES']['COMMENTS']['VALUE']['TEXT']?></p>
						<?}?>
					</div>
							<?
							global $USER;
							if ($USER->IsAdmin())
							{
							// echo "<pre>"; print_r($arItem); echo "</pre>";
							}
							?>


					<div class="review-item__bottom">
						<a class="review-item__link js-btn-answer" data-fancybox="" data-src="#review-answer-form" href="javascript:;" data-id="<?=$arItem['ID']?>"><?=GetMessage('T_REVIEW_BTN_ANSWER')?></a>
							
						<?global $USER;?>
						<?if ($USER->IsAdmin()){?>
							<a class="review-item__link js-edit-review" data-id="<?=$arItem['ID']?>" data-fancybox="" data-src="#edit-main-review" href="javascript:;"><?=GetMessage('T_REVIEW_BTN_EDIT')?></a>
							<span class="review-item__link" onclick="hideElem(<?=$arItem['ID']?>);"><?=GetMessage('T_REVIEW_BTN_HIDE')?></span>
							<span class="review-item__link" onclick="delElem(<?=$arItem['ID']?>, <?=$arItem['IBLOCK_ID']?>, false);"><?=GetMessage('T_REVIEW_BTN_DELETE')?></span>
						<?}?>
						<?//<a class="review-item__link" href="#">Спам</a>?>
					</div>

					<?if($arItem['ANSWERS']){?>
						<div class="review-item__answers">
							<?foreach ($arItem['ANSWERS'] as $answer) {?>
								<div class="review-item__answers-item js-review-item-answers">
									<div class="review-item__top">
										<div class="review-item__info">
											<div class="review-item__author"><?=$answer['NAME']?></div>
											<?if($answer['DATE_ACTIVE_FROM']){?>
												<div class="review-item__date"><?=$answer['DATE_ACTIVE_FROM']?></div>
											<?}?>
										</div>
									</div>
									<div class="review-item__content">
										<p class="js-review-comment"><?=$answer['PREVIEW_TEXT']?></p>
									</div>
									<div class="review-item__bottom">
										<?/*<!-- <a class="review-item__link" href="#">Ответить</a> -->*/?>

										<?global $USER;?>
										<?if ($USER->IsAdmin()){?>
											<a class="review-item__link js-edit-review-comment" data-id="<?=$answer['ID']?>" data-fancybox="" data-src="#edit-comment-review" href="javascript:;"><?=GetMessage('T_REVIEW_BTN_EDIT')?></a>
											<span class="review-item__link" onclick="hideElem(<?=$answer['ID']?>);"><?=GetMessage('T_REVIEW_BTN_HIDE')?></span>
											<span class="review-item__link" onclick="delElem(<?=$answer['ID']?>, <?=$arParams['IBLOCK_ID_ANSWER']?>, <?=$arParams['IBLOCK_ID_ANSWER']?>);"><?=GetMessage('T_REVIEW_BTN_DELETE')?></span>
										<?}?>
										<?/*<!-- <a class="review-item__link" href="#">Спам</a> -->*/?>
									</div>
								</div>
							<?}?>
						</div>
					<?}?>
				</div>
			<?endforeach;?>
		</div>

		<?if($arParams["DISPLAY_BOTTOM_PAGER"] && $arResult["NAV_STRING"]):?>
			<div class="nav-page">
				<a class="btn" href="#"><span>Показать еще</span></a>
				<?/*=$arResult["NAV_STRING"]*/?>
			</div>
		<?endif;?>
	<?} else {?>
		<div class="review__top">
			<div class="review__title">Отзывы (<?=count($arResult['ITEMS'])?>)</div>

			<div class="review__action">
				<a class="review__link js-add-review" data-fancybox="" data-src="#review-form" href="javascript:;">Оставить отзыв</a>
			</div>
		</div>
		
		<div class="review__empty">Отзывов по данному товару нет.</div>
	<?}?>
</div>








