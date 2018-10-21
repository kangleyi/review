package cn.edu.review.services.interfaces;

import cn.edu.review.bean.Movie;

import java.util.List;

public interface MovieService {
    List<Movie> queryAll(Movie movie);

    int edit(Movie movie);

    Movie get(Integer id);
}
