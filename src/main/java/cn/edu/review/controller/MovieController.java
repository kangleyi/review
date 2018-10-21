package cn.edu.review.controller;

import cn.edu.review.bean.Movie;
import cn.edu.review.services.interfaces.MovieService;
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

    @RequestMapping("/all")
    private Result queryAllMovie(Movie movie){
        return Result.Success(movieService.queryAll(movie));
    }

    @RequestMapping("/save")
    private Result save(Movie movie, MultipartFile file, HttpServletRequest request){
        if(movie.getId()!=null){
            return Result.Success(movieService.edit(movie));
        }else{
            String filename=UUID.randomUUID().toString();
            String fileName=file.getOriginalFilename();
            String Extname=fileName.substring(fileName.lastIndexOf(".")+1);
            String path=request.getServletContext().getRealPath("/src/media/big/");
            System.out.println(path);
            File d=new File(path);
            try {
                FileUtils.copyInputStreamToFile(file.getInputStream(), new File(d,filename+"."+Extname));
            } catch (IOException e) {
                e.printStackTrace();
            }
            movie.setImg("/src/media/big/"+filename+"."+Extname);
            return Result.Success(1);
        }
    }

    @RequestMapping("/editInit")
    private Result get(Integer id){
        return Result.Success(movieService.get(id));
    }

    @RequestMapping("/delete")
    private Result delete(Movie movie){
        movie.setFlag(1);
        if(movie.getId()!=null){
            return Result.Success(movieService.edit(movie));
        }
        return Result.Error("Id is not null");
    }
}
