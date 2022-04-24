CREATE TABLE todos (
  id INT NOT NULL AUTO_INCREMENT,
  is_done BOOL DEFAULT false,
  title TEXT,
  PRIMARY KEY (id)
);

INSERT INTO todos (title) VALUES ('納豆');
INSERT INTO todos (title) VALUES ('キャベツ');
INSERT INTO todos (title, is_done) VALUES ('小松菜', true);
INSERT INTO todos (title) VALUES ('玉ねぎ');

SELECT * FROM todos; 
