package cn.edu.review.services.impl;

import cn.edu.review.bean.Movie;
import cn.edu.review.mapper.MovieMapper;
import cn.edu.review.services.interfaces.MovieService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.List;

@Service
public class IMovieService implements MovieService {

    @Autowired
    private MovieMapper movieMapper;

    @Override
    public List<Movie> queryAll(Movie movie) {
        return movieMapper.query(movie);
    }

    @Override
    public int edit(Movie movie) {
        if(movie.getId()!=null)
        return movieMapper.updateByPrimaryKeySelective(movie);
        return movieMapper.insertSelective(movie);
    }

    @Override
    public Movie get(Integer id) {
        return movieMapper.selectByPrimaryKey(id);
    }
}
