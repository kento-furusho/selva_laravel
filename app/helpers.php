<?php
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ReviewRequest;
use App\Models\Review;

if (! function_exists('getReviewAverage')) {
    /**
     * 関数の説明文
     *
     *
     */
    function getReviewAverage($id)
    {
        $sum = 0;
        $product = Product::find($id);
        $reviews = $product->reviews;
        $countReviews = count($reviews);
        for($i=0; $i<$countReviews; $i++){
            $sum += $reviews[$i]->evaluation;
        }
        if($sum !== 0) {
            $reviewAverage = ceil($sum / $countReviews);
            $star = '';
            for($i=0; $i<$reviewAverage; $i++){
                $star = $star.'★';
            }
            return $star.' '.intval($reviewAverage);
        } else {
            return 'レビューはまだありません';
        }
    }
}
?>
