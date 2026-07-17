export const getSeederUser = (role) => {
    switch (role) {
        case 'admin': return { email: 'admin@tokokita.com', password: 'password' };
        case 'penjual': return { email: 'penjual1@tokokita.com', password: 'password' };
        case 'pembeli': return { email: 'pembeli1@tokokita.com', password: 'password' };
    }
};
