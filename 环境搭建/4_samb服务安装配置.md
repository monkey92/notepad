# install

```bash
sudo apt install samba

# ddc 必须是系统用户
sudo smbpasswd -a ddc 

```


# configure

```text

[projects]
   comment = projects
   browseable = yes
   path = /home/ddc/projects
   writable = yes
   public = no
   
   



```