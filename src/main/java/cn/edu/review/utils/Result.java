package cn.edu.review.utils;

public class Result {
    private String msg;
    private int code;
    private Object data;

    public String getMsg() {
        return msg;
    }

    public void setMsg(String msg) {
        this.msg = msg;
    }

    public int getCode() {
        return code;
    }

    public void setCode(int code) {
        this.code = code;
    }

    public Object getData() {
        return data;
    }

    public void setData(Object data) {
        this.data = data;
    }

    public Result( int code,String msg) {
        this.msg = msg;
        this.code = code;
    }

    public Result(int code, Object data) {
        this.code = code;
        this.data = data;
    }

    public Result() {
    }

    public static Result Success(Object o){
        return new Result(200,o);
    }

    public static Result Error(String msg){
        return new Result(500,msg);
    }
}
