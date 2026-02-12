# Setting Up Automatic Deployment with GitHub Actions

To make the deployment workflow work, you need to configure **Secrets** in your GitHub repository.

## 1. Generate an SSH Key Pair (On Your Local Machine)

If you don't have an SSH key specifically for deployment, generate one:
```bash
ssh-keygen -t ed25519 -C "github-actions-deploy" -f github_deploy_key
```
- Press Enter for no passphrase (it must be passwordless for automation).
- This creates two files: `github_deploy_key` (private) and `github_deploy_key.pub` (public).

## 2. Add Public Key to Your Server (On Your Server)

1. **Copy the contents** of `github_deploy_key.pub`.
2. **SSH into your server**:
   ```bash
   ssh root@your-server-ip
   ```
3. **Add the key to authorized_keys**:
   ```bash
   # Create .ssh directory if it doesn't exist
   mkdir -p ~/.ssh

   # Add the public key (paste the content of github_deploy_key.pub)
   echo "YOUR_PUBLIC_KEY_CONTENT_HERE" >> ~/.ssh/authorized_keys

   # Set correct permissions
   chmod 700 ~/.ssh
   chmod 600 ~/.ssh/authorized_keys
   ```

## 3. Add Secrets to GitHub

1. Go to your GitHub Repository -> **Settings** -> **Secrets and variables** -> **Actions**.
2. Click **New repository secret** and add the following:

| Name | Value |
|------|-------|
| `SERVER_HOST` | Your server's IP address (e.g., `123.45.67.89`) |
| `SERVER_USER` | The username you use to SSH (usually `root`) |
| `SSH_PRIVATE_KEY` | The **entire content** of the PRIVATE key file (`github_deploy_key`) you generated in Step 1. Start with `-----BEGIN...` |
| `SERVER_PORT` | `22` (or your custom SSH port if changed) |

## 4. Verify Server Setup

Ensure your project is already cloned on the server in the correct path:
```bash
cd /www/wwwroot/
git clone https://github.com/your-username/your-repo.git stafflink.diorestu.my.id
# OR if it already exists
cd stafflink.diorestu.my.id
git pull origin main
```

## 5. Push Changes

Now, whenever you push to the `main` branch, GitHub Actions will:
1. SSH into your server.
2. Pull the latest code.
3. Install dependencies.
4. Run migrations.
5. Clear caches.

🚀 **Done!**
