<template>
    <div class="main-body" v-if="user">
        <leftsidebar-component></leftsidebar-component>

        <div class="content-body">
            <div class="about-content">
                <h3 v-if="user">About The Application!</h3>
                <!-- <span v-else>Guest</span> -->
                <p>
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                    Facere esse quis vero consequatur, obcaecati sequi tenetur
                    reiciendis cupiditate totam temporibus ratione voluptatibus
                    rerum ea tempora explicabo ex exercitationem? Similique
                    maiores esse numquam veniam aliquam totam tempora non
                    mollitia placeat facilis, labore earum sapiente. Fuga
                    placeat cum minus id expedita dolores rerum tenetur a,
                    veritatis voluptate quas quae qui quis optio facilis itaque
                    aliquid? Assumenda iusto voluptatem a facilis hic eius
                    fugiat nulla eaque quae quis nesciunt ad esse quam sunt,
                    recusandae asperiores magnam nam maxime quod exercitationem.
                    Quis nisi doloremque nihil maiores qui, alias, quia officiis
                    itaque voluptate libero cumque maxime, incidunt quasi
                    aliquam nesciunt quaerat facere? Sit, placeat, adipisci
                    accusamus natus numquam, non veritatis eveniet odio a
                    voluptas cupiditate dolorum? Saepe, animi deserunt.
                    Consequatur tempore praesentium dolores perspiciatis iure?
                    Placeat et quam accusantium tempora ducimus nostrum,
                    mollitia harum ipsam alias totam quia animi omnis quod
                    quidem id voluptas assumenda laborum commodi optio molestiae
                    ad? Facere ipsa optio quod voluptas accusamus! Non sequi
                    atque laborum quas ducimus exercitationem modi velit
                    voluptas quibusdam doloribus quae veniam iure ab autem
                    repudiandae alias, nihil repellat, et rerum pariatur at
                    quasi perspiciatis, fugit culpa? Sunt enim velit distinctio
                    fugit, placeat ad officia modi qui? Lorem ipsum dolor sit
                    amet consectetur adipisicing elit. Nulla ab reprehenderit
                    inventore nobis sunt ex aut amet praesentium, repellendus at
                    maxime cumque odit temporibus modi! Id, non quo perferendis
                    eveniet quod quidem exercitationem fugiat veritatis minima
                    rerum adipisci! Placeat iste deserunt cum alias dolor quis
                    necessitatibus odit reiciendis sed quas. Assumenda,
                    inventore vero asperiores porro, ipsam totam odio aliquid
                    iusto a dolor laborum similique consectetur amet? Illo
                    dolores sequi recusandae, deleniti excepturi ullam.
                    Accusantium, sequi aliquid ad illum tempore nihil et cumque
                    consectetur libero iusto delectus sunt veniam, fugit soluta
                    culpa quae? Recusandae distinctio, quisquam culpa pariatur
                    ut sequi dolorum aut fugiat placeat, ab vitae amet odio iure
                    voluptatem ducimus ex provident cum cumque doloribus
                    aspernatur nesciunt ratione veritatis! Molestiae, ipsa saepe
                    nulla iste alias animi vitae suscipit accusamus quas
                    ducimus, facere nisi a repellendus praesentium, tenetur
                    quaerat. Nobis deserunt ducimus libero tenetur accusantium
                    odit quos ad ipsum unde, similique animi quaerat nam nisi
                    exercitationem tempore laudantium quibusdam rem consequatur
                    voluptatibus minima labore laboriosam voluptate dolorem?
                    Similique cumque minus asperiores fuga perferendis quae
                    error autem. Sequi quas iste, voluptates quo error minima
                    omnis, consectetur ab amet, illo sit! Doloremque, laudantium
                    accusamus. Ab fugit accusamus error perspiciatis quis hic
                    quod vitae obcaecati tempora cum repellendus optio libero,
                    mollitia debitis nesciunt eligendi, doloribus atque earum
                    placeat autem consectetur et tenetur perferendis! Fugit
                    commodi, voluptatibus, quae nemo molestias eaque illum
                    voluptatum corrupti quos eius similique deserunt veritatis!
                    Dolore quod ab dolorem excepturi sequi aliquid hic culpa,
                    amet nulla expedita. Reiciendis fugit libero non.
                </p>
            </div>
        </div>
    </div>

    <div class="main-body" v-else>
        <div class="about-content">
            <h3>About The Application!</h3>
            <p>
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Facere
                esse quis vero consequatur, obcaecati sequi tenetur reiciendis
                cupiditate totam temporibus ratione voluptatibus rerum ea
                tempora explicabo ex exercitationem? Similique maiores esse
                numquam veniam aliquam totam tempora non mollitia placeat
                facilis, labore earum sapiente. Fuga placeat cum minus id
                expedita dolores rerum tenetur a, veritatis voluptate quas quae
                qui quis optio facilis itaque aliquid? Assumenda iusto
                voluptatem a facilis hic eius fugiat nulla eaque quae quis
                nesciunt ad esse quam sunt, recusandae asperiores magnam nam
                maxime quod exercitationem. Quis nisi doloremque nihil maiores
                qui, alias, quia officiis itaque voluptate libero cumque maxime,
                incidunt quasi aliquam nesciunt quaerat facere? Sit, placeat,
                adipisci accusamus natus numquam, non veritatis eveniet odio a
                voluptas cupiditate dolorum? Saepe, animi deserunt. Consequatur
                tempore praesentium dolores perspiciatis iure? Placeat et quam
                accusantium tempora ducimus nostrum, mollitia harum ipsam alias
                totam quia animi omnis quod quidem id voluptas assumenda laborum
                commodi optio molestiae ad? Facere ipsa optio quod voluptas
                accusamus! Non sequi atque laborum quas ducimus exercitationem
                modi velit voluptas quibusdam doloribus quae veniam iure ab
                autem repudiandae alias, nihil repellat, et rerum pariatur at
                quasi perspiciatis, fugit culpa? Sunt enim velit distinctio
                fugit, placeat ad officia modi qui? Lorem ipsum dolor, sit amet
                consectetur adipisicing elit. Perferendis, laborum magni libero
                earum ab possimus at aut, nesciunt aperiam voluptatum iusto
                eaque. Dolor repudiandae tempora fuga sit id veniam quam in
                eveniet maiores quibusdam. Esse temporibus rerum eius tempora,
                placeat soluta autem amet unde dolorem saepe veritatis voluptate
                facere voluptatum aspernatur obcaecati earum ab inventore odit
                accusantium perspiciatis possimus. Excepturi, at, consequuntur
                animi quia, cupiditate minima eos sint dolore voluptas a ut est.
                Aliquam cum consequuntur eos. Eaque quis nisi iure tenetur
                obcaecati a laboriosam maxime officiis alias quo cum corporis
                cupiditate adipisci repellat asperiores, harum cumque vero
                architecto at? Vel, voluptate deserunt velit asperiores
                recusandae, non porro eveniet, dolorem itaque officiis quos?
                Odit, quos? Quibusdam mollitia aliquid, sed ipsum tempore itaque
                pariatur odit nostrum impedit eum nam atque fuga ipsam, eius
                voluptatum sit dolorem quis id assumenda tempora ipsa suscipit.
                Reiciendis porro earum quisquam, minus sapiente fugiat velit
                debitis autem rerum error ratione non eveniet tenetur, tempora,
                fugit atque eligendi perspiciatis sunt dolor voluptas explicabo
                deleniti vero! Ut temporibus aspernatur blanditiis nam sint enim
                reiciendis in tempora? Repellat ut praesentium neque explicabo
                fuga laborum facere nemo optio eum. Quam necessitatibus, omnis
                repellat nisi esse temporibus odit obcaecati eius explicabo,
                asperiores qui? Officiis laudantium quo iste inventore quas
                tempore soluta error dignissimos dolorem vero, vel iusto quae ab
                consequuntur unde recusandae aut repudiandae perspiciatis
                quisquam commodi maxime temporibus labore ullam. Nobis ea sunt
                dignissimos ipsum, nemo iste neque ipsa sapiente illum ab
                quibusdam dolore suscipit animi ullam! At, amet doloremque?
            </p>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            user: null
        };
    },
    mounted() {
        axios
            .get("/api/user")
            .then(response => {
                this.user = response.data;
                localStorage.setItem("role", response.data.role);
            })
            .catch(error => {
                if (error.response.status === 401) {
                    console.log("401 (Unauthorized) error caught!");
                }
            });
    }
};
</script>
