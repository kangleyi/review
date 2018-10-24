package cn.edu.review.controller;

import cn.edu.review.bean.User;
import cn.edu.review.services.interfaces.UserService;
import cn.edu.review.utils.MD5Util;
import cn.edu.review.utils.Result;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import javax.servlet.http.HttpSession;

@RestController
@RequestMapping("/user")
public class UserController {
    @Autowired
    private UserService userService;

    @RequestMapping("/login")
    public Result login(User user){
        user.setPassword(MD5Util.encodeByMD5(user.getPassword()));
        user=userService.login(user);
        if(user!=null){
            if(user.getDelFlag()==1){
                return Result.Error("Forbid login");
            }else{
                return Result.Success(user);
            }
        }
        return Result.Error("username/password is error!");
    }

    @RequestMapping("/register")
    public Result register(User user){
        if(userService.queryByUserName(user.getUsername())>0){
            return Result.Error("User exists");
        }else{
            user.setPassword(MD5Util.encodeByMD5(user.getPassword()));
            user=userService.save(user);
            return Result.Success(user);
        }
    }

    @RequestMapping("/edit")
    public Result edit(User user){
        if(user.getId()!=null){
            if(user.getUsername()!=null&&user.getUsername().length()>0)
                user.setPassword(MD5Util.encodeByMD5(user.getPassword()));
            return Result.Success(userService.edit(user));
        }
        return Result.Error("Param is not found");
    }

    @RequestMapping("/queryAll")
    public Result queryUsers(User user){
        return Result.Success(userService.queryAll(user));
    }
}
