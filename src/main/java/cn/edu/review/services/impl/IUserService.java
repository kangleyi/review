package cn.edu.review.services.impl;

import cn.edu.review.bean.User;
import cn.edu.review.mapper.UserMapper;
import cn.edu.review.services.interfaces.UserService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.List;


@Service
public class IUserService implements UserService {
    @Autowired
    private UserMapper userMapper;

    @Override
    public int queryByUserName(String username) {
        User user=new User();user.setUsername(username);
        return userMapper.query(user).size();
    }

    @Override
    public User save(User user) {
        userMapper.insertSelective(user);
        return userMapper.query(user).get(0);
    }

    @Override
    public User login(User user) {
        List<User> users=userMapper.query(user);
        if(users.size()>0)
        return users.get(0);
        return null;
    }

    @Override
    public int edit(User user) {
        return userMapper.updateByPrimaryKeySelective(user);
    }

    @Override
    public List<User> queryAll(User user) {
        return userMapper.query(user);
    }

    @Override
    public User get(Integer id) {
        return userMapper.selectByPrimaryKey(id);
    }
}
