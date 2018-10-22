package cn.edu.review.services.interfaces;

import cn.edu.review.bean.Reply;
import cn.edu.review.bean.Review;

import java.util.List;

public interface ReviewService {
    int addReview(Review review);

    List<Review> query(Review review);

    int addReply(Reply reply);

    int save(Review review);

    int deleteReply(Integer id);
}
