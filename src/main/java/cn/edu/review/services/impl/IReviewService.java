package cn.edu.review.services.impl;

import cn.edu.review.bean.Reply;
import cn.edu.review.bean.Review;
import cn.edu.review.mapper.ReplyMapper;
import cn.edu.review.mapper.ReviewMapper;
import cn.edu.review.services.interfaces.ReviewService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.Date;
import java.util.List;

@Service
public class IReviewService implements ReviewService {
    @Autowired
    private ReviewMapper reviewMapper;
    @Autowired
    private ReplyMapper replyMapper;

    @Override
    public int addReview(Review review) {
        review.setCreateTime(new Date());
        return reviewMapper.insertSelective(review);
    }

    @Override
    public List<Review> query(Review review) {
        return reviewMapper.query(review);
    }

    @Override
    public int addReply(Reply reply) {
        reply.setCreateTime(new Date());
        return replyMapper.insertSelective(reply);
    }

    @Override
    public int save(Review review) {
        return reviewMapper.updateByPrimaryKeySelective(review);
    }

    @Override
    public int deleteReply(Integer id) {
        return replyMapper.deleteByPrimaryKey(id);
    }
}
