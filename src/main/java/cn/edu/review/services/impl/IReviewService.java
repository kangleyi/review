package cn.edu.review.services.impl;

import cn.edu.review.mapper.ReplyMapper;
import cn.edu.review.mapper.ReviewMapper;
import cn.edu.review.services.interfaces.ReviewService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

@Service
public class IReviewService implements ReviewService {
    @Autowired
    private ReviewMapper reviewMapper;
    @Autowired
    private ReplyMapper replyMapper;
}
