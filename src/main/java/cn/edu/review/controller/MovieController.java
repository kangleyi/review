package cn.edu.review.controller;

import cn.edu.review.bean.Movie;
import cn.edu.review.bean.Reply;
import cn.edu.review.bean.Review;
import cn.edu.review.services.interfaces.MovieService;
import cn.edu.review.services.interfaces.ReviewService;
import cn.edu.review.services.interfaces.UserService;
import cn.edu.review.utils.Result;
import org.apache.commons.io.FileUtils;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;
import org.springframework.web.multipart.MultipartFile;

import javax.servlet.http.HttpServletRequest;
import java.io.File;
import java.io.IOException;
import java.util.UUID;

@RestController
@RequestMapping("/movie")
public class MovieController {
    @Autowired
    private MovieService movieService;
    @Autowired
    private ReviewService reviewService;
    @Autowired
    private UserService userService;

    @RequestMapping("/all")
    public Result queryAllMovie(Movie movie){
        return Result.Success(movieService.queryAll(movie));
    }

    @RequestMapping("/save")
    public Result save(Movie movie, MultipartFile file, HttpServletRequest request){
        if(file!=null){
            String filename=UUID.randomUUID().toString();
            String fileName=file.getOriginalFilename();
            String Extname=fileName.substring(fileName.lastIndexOf(".")+1);
            String path=request.getServletContext().getRealPath("/src/");
            System.out.println(path);
            File d=new File(path);
            try {
                FileUtils.copyInputStreamToFile(file.getInputStream(), new File(d,filename+"."+Extname));
            } catch (IOException e) {
                e.printStackTrace();
            }
            movie.setImg("/src/media/big/"+filename+"."+Extname);
        }
        return Result.Success(movieService.save(movie));
    }

    @RequestMapping("/editInit")
    public Result get(Integer id){
        return Result.Success(movieService.get(id));
    }

    @RequestMapping("/delete")
    public Result delete(Movie movie){
        movie.setFlag(1);
        if(movie.getId()!=null){
            return Result.Success(movieService.save(movie));
        }
        return Result.Error("Id is not null");
    }

    @RequestMapping("/getReviews")
    public Result getReviews(Review review){
        return Result.Success(reviewService.query(review));
    }

    @RequestMapping("/review")
    public Result review(Review review){
        if(userService.get(review.getCreateId()).getIsForbid()==0)
        return Result.Success(reviewService.addReview(review));
        return Result.Error("Account is forbid");
    }

    @RequestMapping("/review/audit")
    public Result reviewAudit(Review review){
        return Result.Success(reviewService.save(review));
    }

    @RequestMapping("/reply")
    public Result review(Reply reply){
        if(userService.get(reply.getCreateId()).getIsForbid()==0)
        return Result.Success(reviewService.addReply(reply));
        return Result.Error("Account is forbid");
    }

    @RequestMapping("/reply/delete")
    public Result review(Integer id){
        return Result.Success(reviewService.deleteReply(id));
    }
}
