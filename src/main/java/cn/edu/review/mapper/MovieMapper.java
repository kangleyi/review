package cn.edu.review.mapper;

import cn.edu.review.bean.Movie;

import java.util.List;

public interface MovieMapper {
    int deleteByPrimaryKey(Integer id);

    int insert(Movie record);

    int insertSelective(Movie record);

    Movie selectByPrimaryKey(Integer id);

    int updateByPrimaryKeySelective(Movie record);

    int updateByPrimaryKey(Movie record);

    List<Movie> query(Movie movie);
}