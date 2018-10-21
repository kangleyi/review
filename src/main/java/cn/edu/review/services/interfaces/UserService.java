package cn.edu.review.services.interfaces;

import cn.edu.review.bean.User;

import java.util.List;


public interface UserService {

    int queryByUserName(String username);

    User save(User user);

    User login(User user);

    int edit(User user);

    List<User> queryAll(User user);
}
